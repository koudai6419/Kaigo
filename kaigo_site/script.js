//＝＝＝＝＝＝＝＝＝＝＝＝ jQueryで設定＝＝＝＝＝＝＝＝＝＝＝＝＝＝

// $(function(){
//   $('#openmenu').click(function(){
//     $('#menu').fadeIn();
//   });
//   $('#closemenu').click(function(){
//     $('#menu').fadeOut();
//   });
//   // ＝＝＝＝＝＝＝＝＝＝＝＝QUESTIONのアコーディオン機能======＝＝＝＝＝
//   $(".question_list").click(function(){
//     var $answer=$(this).find(".answer");
//     if ($answer.hasClass("open")){
//       $answer.slideUp();
//       $(this).find("span").text("+");
//       $answer.removeClass("open");
//     }else{
//       $answer.slideDown();
//       $(this).find("span").text("-");
//       $answer.addClass("open");
//     }
//   });
// });

//＝＝＝＝＝＝＝＝＝＝＝＝ javascriptで設定＝＝＝＝＝＝＝＝＝＝＝＝＝＝

'use strict';

{
  //＝＝＝＝＝＝＝＝＝＝＝＝ ハンバーガーメニュー＝＝＝＝＝＝＝＝＝＝＝＝
  const open = document.getElementById('openmenu');
  const menu = document.getElementById('menu');
  const close = document.getElementById('closemenu');

  open.addEventListener('click', () => {
    menu.classList.add('show');
    open.classList.add('hide');
  });

  close.addEventListener('click', () => {
    menu.classList.remove('show');
    open.classList.remove('hide');
  });

  // ＝＝＝＝＝＝＝＝＝＝＝＝QUESTIONのアコーディオン機能======＝＝＝＝＝
  const questions = document.querySelectorAll('.question');
  const answers = document.querySelectorAll('.answer');

  for(let i=0; i<questions.length; i++){
    let question = questions[i];
    let answer = answers[i];
    question.addEventListener('click', () => {
      answer.classList.toggle('is-open');
    });
  }  
}



