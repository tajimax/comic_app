 (()=>{
     const $doc = document;
     const $tab = $doc.getElementById('js-tab');
     const $nav = $tab.querySelectorAll('[data-nav]');
     const $content = $tab.querySelectorAll('[data-content]');
     // 初期化
     const init = () => {
         $content[0].classList.add('active');
         $nav[0].classList.add('active');
     }
     init();
     // クリックイベント
     const handleClick = (e) => {
         e.preventDefault();
        
         // クリックされたnavとそのデータを取得
         const $this = e.target;
         const targetVal = $this.dataset.nav;

         // nav, contentすべてを一旦リセット
         let index = 0;
         while(index < $nav.length){
             $content[index].classList.remove('active');
             $nav[index].classList.remove('active');
             index++;
         }
         console.log('[data-content="' + targetVal + '"]');

         // 対象のコンテンツをアクティブ化
         $tab.querySelectorAll('[data-content="' + targetVal + '"]')[0].classList.add('active');
         $nav[targetVal].classList.add('active');
     };
     // 全ナビゲーション要素に対して関数を適用
     let index = 0;
     while(index < $nav.length){
         $nav[index].addEventListener('click', (e) => handleClick(e));
         index++;
     }
 })();