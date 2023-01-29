{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    const categorySelectBox = document.querySelector('#js-ajax-change-subcategories')

    const subCategorySelectBox = document.querySelector('#js-ajax-target-field')

    categorySelectBox.addEventListener("change", (e) => {

        const categoryId = e.target.value

        fetch('/set-subcategory/' + categoryId, {
            method: 'GET',
        })
        .then(response => {
            return response.json();
        })
        .then(json => {
            // サブカテゴリの中身をすべて削除
            while (subCategorySelectBox.firstChild)
            {
                subCategorySelectBox.removeChild(subCategorySelectBox.firstChild)
            }

            const subCategoriesLinkedWithCategory = json.product_subcategories

            // option tagを作成
            subCategoriesLinkedWithCategory.forEach(subCategory => {
                const optionTag = document.createElement("option")
                optionTag.setAttribute("value", subCategory.id)
                optionTag.innerHTML = subCategory.name

                console.log(optionTag)

                subCategorySelectBox.append(optionTag)
            });
        })

    })

    // 画像upload ajax

    const imageUploader1 = document.querySelector('.image-uploader1')

    const imagePreview1 = document.querySelector('.image-preview1')

    const inputHidden1 = document.querySelector('.image-path-hidden1')

    imageUploader1.addEventListener("change", (e) => {

        const file = e.target.files[0]
        const form = new FormData()

        //フォームデータにアップロードファイルの情報追加

        form.append("image_1", file)

        console.log(form.get("image_1"))

        fetch('register-product-image', {
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
            console.log(json['returnFileName1'])
            imagePreview1.setAttribute("src", '/storage/' + json['returnFileName1'])
            inputHidden1.setAttribute("value", json['returnFileName1'])
        })

    })
}
