{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    const categorySelectBox = document.querySelector('#js-ajax-change-subcategories')

    const subCategorySelectBox = document.querySelector('#js-ajax-target-field')

    // サブカテゴリセットする。
    categorySelectBox.addEventListener("change", (e) => {
        const categoryId = e.target.value

        console.log("a")

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

            // コントローラから取得したカテゴリに紐づくサブカテゴリを変数に格納
            const subCategoriesLinkedWithCategory = json.product_subcategories

            // サブカテゴリのoption tagを作成してDOMに配置
            subCategoriesLinkedWithCategory.forEach(subCategory => {
                const optionTag = document.createElement("option")
                // サブカテゴリのidをoptionタグにセット
                optionTag.setAttribute("value", subCategory.id)
                optionTag.innerHTML = subCategory.name

                subCategorySelectBox.append(optionTag)

            });
        })

    })

    // 画像upload ajax

    const imageUploader1 = document.querySelector('.image-uploader1')

    const imagePreview1 = document.querySelector('.image-preview1')

    const inputHidden1 = document.querySelector('.image-path-hidden1')

    const imageUploader2 = document.querySelector('.image-uploader2')

    const imagePreview2 = document.querySelector('.image-preview2')

    const inputHidden2 = document.querySelector('.image-path-hidden2')

    const imageUploader3 = document.querySelector('.image-uploader3')

    const imagePreview3 = document.querySelector('.image-preview3')

    const inputHidden3 = document.querySelector('.image-path-hidden3')

    const imageUploader4 = document.querySelector('.image-uploader4')

    const imagePreview4 = document.querySelector('.image-preview4')

    const inputHidden4 = document.querySelector('.image-path-hidden4')

    const imageErrMsg1 = document.querySelector('.image-err-msg1')
    const imageErrMsg2 = document.querySelector('.image-err-msg2')
    const imageErrMsg3 = document.querySelector('.image-err-msg3')
    const imageErrMsg4 = document.querySelector('.image-err-msg4')

    imageUploader1.addEventListener("change", (e) => {

        const file = e.target.files[0]
        const form = new FormData()

        //フォームデータにアップロードファイルの情報追加

        form.append("image_1", file)


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
        // .catch((error) => {
        //     console.log('alj')
        // })
        .then(json => {
            console.log(Object.keys(json))
            if (Object.keys(json) == 'returnErr')
            {
                imageErrMsg1.textContent = '画像は10MB以下でかつjpg、jpeg、png、gifのファイルのみアップロード可能です。'

            } else if (Object.keys(json) == 'returnFileName1')
            {
                imagePreview1.style.display = 'inline'
                imagePreview1.setAttribute("src", '/storage/' + json['returnFileName1'])
                inputHidden1.setAttribute("value", json['returnFileName1'])
            }

        })

    })

    imageUploader2.addEventListener("change", (e) => {

        const file = e.target.files[0]
        const form = new FormData()

        //フォームデータにアップロードファイルの情報追加

        form.append("image_2", file)

        console.log(form.get("image_2"))

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
            if (Object.keys(json) == 'returnErr')
            {
                imageErrMsg2.textContent = '画像は10MB以下でかつjpg、jpeg、png、gifのファイルのみアップロード可能です。'

            } else if (Object.keys(json) == 'returnFileName2')
            {
                imagePreview2.style.display = 'inline'

                imagePreview2.setAttribute("src", '/storage/' + json['returnFileName2'])
                inputHidden2.setAttribute("value", json['returnFileName2'])
            }

        })
    })
    imageUploader3.addEventListener("change", (e) => {

        const file = e.target.files[0]
        const form = new FormData()

        //フォームデータにアップロードファイルの情報追加

        form.append("image_3", file)

        console.log(form.get("image_3"))

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
            if (Object.keys(json) == 'returnErr')
            {
                imageErrMsg3.textContent = '画像は10MB以下でかつjpg、jpeg、png、gifのファイルのみアップロード可能です。'

            } else if (Object.keys(json) == 'returnFileName3')
            {
                imagePreview3.style.display = 'inline'
                imagePreview3.setAttribute("src", '/storage/' + json['returnFileName3'])
                inputHidden3.setAttribute("value", json['returnFileName3'])
            }

        })
    })

    imageUploader4.addEventListener("change", (e) => {

        const file = e.target.files[0]
        const form = new FormData()

        //フォームデータにアップロードファイルの情報追加

        form.append("image_4", file)


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

            if (Object.keys(json) == 'returnErr')
            {
                imageErrMsg4.textContent = '画像は10MB以下でかつjpg、jpeg、png、gifのファイルのみアップロード可能です。'

            } else if (Object.keys(json) == 'returnFileName4')
            {
                imagePreview4.style.display = 'inline'
                imagePreview4.setAttribute("src", '/storage/' + json['returnFileName4'])
                inputHidden4.setAttribute("value", json['returnFileName4'])
            }

        })
    })
}
