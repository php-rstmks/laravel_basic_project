const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const imageUploader1 = document.querySelector('.image-uploader1')

const imagePreview1 = document.querySelector('.image-preview1')

const inputHidden1 = document.querySelector('.image-path-hidden1')


imageUploader1.addEventListener("change", (e) => {

    const file = e.target.files[0]
    const form = new FormData()

    //フォームデータにアップロードファイルの情報追加

    form.append("image_1", file)

    console.log(form.get("image_1"))

    fetch('/upload/image', {
        method: 'POST',
        headers: {
            'X-CSRF-Token': token,
        },
        body: form
    })
    .then(response => {
        return response.json()
    })
    .then(json => {
        imagePreview1.setAttribute("src", '/storage/' + json['returnFileName1'])
        inputHidden1.setAttribute("value", json['returnFileName1'])
    })
})
