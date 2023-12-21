// アコーディオンメニューの記述
// jQuery(function ($) {
//   $('.js-accordion-title').on('click', function () {
//     // コンテンツ展開
//     $(this).next().slideToggle(200);
//     // 矢印の向き変更
//     $(this).toggleClass('open', 200);
//   }).next().hide();
// });


// $(document).ready(function () {
//   // メニューがクリックされたら
//   $('#user-menu').click(function () {
//     // アコーディオンメニューの表示・非表示を切り替える
//     $('#accordion-menu').slideToggle();

//     // 矢印の方向を反転させる
//     $('.arrow-icon').toggleClass('up');
//   });
// });

$(function () {
  $('.arrow-icon').click(function () {
    $('.kodomo').slideToggle();
  });
});

// ヘッダー矢印の記述
$(function () {
  $('.arrow-icon').click(function () {
    $(this).toggleClass('active');
  });
});

$(document).ready(function () {
  $('#editPostModal').on('shown.bs.modal', function () {
    // モーダルが表示されたときの処理を追加
  });
});
