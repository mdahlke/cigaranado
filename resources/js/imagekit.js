import ImageKit from "imagekit-javascript"

const imagekit = new ImageKit({
    urlEndpoint: "https://ik.imagekit.io/vitola", // Required. Default URL-endpoint is https://ik.imagekit.io/your_imagekit_id
    publicKey: "public_8LLiw9fsXQ2M48PRH7bIQCVfokU=", // optional
    // authenticationEndpoint: "https://www.your-server.com/auth" // optional
    // transformationPosition: "path" // optional
});

export default imagekit;