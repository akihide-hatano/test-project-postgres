let destory = document.getElementById('delete');

if(destory){
destory.addEventListener('click',function(e){
    if(!confirm('本当に削除しますか?')){
    e.preventDefault();
    }
});
}

//要素を取得
const bodyTextarea = document.getElementById('body');
const charCountSpan = document.getElementById('charCount');
const maxCharsSpan = document.getElementById('maxChars');

//文字数カウンターを初期化
    if (bodyTextarea && charCountSpan && maxCharsSpan) {
        const maxChars = parseInt(maxCharsSpan.textContent);

     // 初期表示の文字数を設定
        charCountSpan.textContent = bodyTextarea.value.length;
        updateCharCountStyle(bodyTextarea.value.length, maxChars, charCountSpan);

    // textareaに入力があるたびに実行されるイベントリスナー
        bodyTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCountSpan.textContent = currentLength;
            updateCharCountStyle(currentLength, maxChars, charCountSpan);
        });

    // 文字数に基づいてスタイルを適用する関数
    function updateCharCountStyle(currentLength, max, charCountElement) {
        const warningThreshold = max*0.8;
        const dangerThreshold = max;

        charCountElement.classList.remove('text-orange-500', 'text-red-500', 'text-gray-500');

        if (currentLength >= dangerThreshold) {
            charCountElement.classList.add('text-red-500');
        } else if (currentLength >= warningThreshold) {
            charCountElement.classList.add('text-orange-500');
        } else {
            charCountElement.classList.add('text-gray-500');
        }
    }
    }

    //要素を取得
    const postForm = document.getElementById('postForm');
    const titleInput = document.getElementById('title');
    const titleError = document.getElementById('titleError');

    const bodyInput = document.getElementById('body');
    const bodyError = document.getElementById('bodyError');

// バリデーションルールを定義 (Laravelのルールに合わせる)
    const RULES = {
        title: {
            required: true,
            max: 20
        },
        body: {
            required: true,
            max: 400
        }
    };

    if (postForm) {
        // フォーム送信時のイベントリスナー
        postForm.addEventListener('submit', function(event) {
            let isValid = true; // フォーム全体のバリデーション結果

            // まず全てのエラーメッセージをクリアする
            titleErrorElement.textContent = '';
            bodyErrorElement.textContent = '';

            // --- titleのバリデーション ---
            const titleValue = titleInput.value.trim(); // 前後の空白を除去

            // 1. required（空項目）チェック
            if (RULES.title.required && titleValue === '') {
                titleErrorElement.textContent = '件名は必須項目です。';
                isValid = false; // バリデーション失敗
            }
            // 2. max（最大文字数）チェック
            else if (RULES.title.max && titleValue.length > RULES.title.max) {
                // `else if` にすることで、必須エラーが出たら文字数エラーは出さないようにする
                titleErrorElement.textContent = `件名は${RULES.title.max}文字以内で入力してください。`;
                isValid = false; // バリデーション失敗
            }

            // --- bodyのバリデーション ---
            const bodyValue = bodyTextareaElement.value.trim(); // 前後の空白を除去
            const bodyMaxLength = RULES.body.max; // 最大文字数を変数に格納

            // 1. required（空項目）チェック
            if (RULES.body.required && bodyValue === '') {
                bodyErrorElement.textContent = '本文は必須項目です。';
                isValid = false;
            }
            // 2. max（最大文字数）チェック
            else if (bodyValue.length > bodyMaxLength) {
                bodyErrorElement.textContent = `本文は${bodyMaxLength}文字以内で入力してください。`;
                isValid = false;
            }


            // フォーム全体のバリデーションが失敗した場合、送信を阻止
            if (!isValid) {
                event.preventDefault(); // フォームの送信を停止
            }
        });
    }
