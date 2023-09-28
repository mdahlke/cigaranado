<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';
import imagekit from '../imagekit.js';

const { modelValue } = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const imagekit_auth = ref({});
const imagekit_loaded = ref(false);
const uploaded = ref(modelValue || []); // Initialize with modelValue

// Watch for changes in uploaded and emit the update:modelValue event
watch(uploaded, (newVal) => {
    emit('update:modelValue', newVal);
});

load_imagekit_auth();

function load_imagekit_auth() {
    axios.get('/imagekit-token').then(response => {
        imagekit_auth.value = response.data;
        imagekit_loaded.value = true;
    }).catch(error => {
        console.log(error);
    });
}

function upload(data) {
    var file = document.getElementById("file1");
    imagekit.upload({
        token: imagekit_auth.value.token,
        signature: imagekit_auth.value.signature,
        expire: imagekit_auth.value.expire,
        file: file.files[0],
        fileName: file.files[0].name,
    }, function (err, result) {
        uploaded.value.push(imagekit.url({
            src: result.url,
            transformation: [{ height: 300, width: 400 }]
        }));
    })
}

async function uploadMultiple(data) {
    const files = document.getElementById("file1");
    const images = [];

    if (files.files.length === 0) {
        return;
    }

    let current_file;

    for (let i = 0; i < files.files.length; i++) {
        current_file = files.files[i];
        const validation = image_valid(current_file);
        const valid = validation.valid;

        if (!valid) {
            continue;
        }

        const url = await uploaded_file_url(current_file).catch(error => {
            console.log(error);
            return false;
        });

        if (!url) {
            continue;
        }

        uploaded.value.push({ file: current_file, url });
    }
}

function image_valid(file) {
    const { name: filename, size: filesize, type: filetype } = file;

    if (filesize > 20000000) {
        return { valid: false, file, message: 'File must be smaller than 20MB' };
    }
    if (!filetype.startsWith("image/")) {
        return { valid: false, file, message: 'File must be an image' };
    }

    return { valid: true, file, message: 'Image is valid' };
}

function uploaded_file_url(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            resolve(reader.result);
        };

        reader.onerror = function (e) {
            reject(e);
        };

        reader.readAsDataURL(file);
    });
}
</script>

<template>
    <div class="image-upload">
        <input v-if="imagekit_loaded" id="file1" type="file" @change="uploadMultiple" multiple />

        <div class="uploaded-images">
            <div v-for="image in uploaded" :key="image" class="uploaded-image">
                <img :src="image.url" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.uploaded-images {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1em;
}

.uploaded-image {
    aspect-ratio: 1;
    box-shadow: 0 0 6px -2px #989898;
    border-radius: 8px;
    overflow: hidden;
}

img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
</style>
