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
