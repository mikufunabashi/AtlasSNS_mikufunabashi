// アコーディンメニューの記述
// $(function () {
//   // ページ読み込み後にアコーディオンメニューを非表示にする
//   $('.according-menu').hide();
//   $('.arrow-icon').click(function () {
//     // ここで要素の表示/非表示を切り替える
//     $(this).siblings('.according-menu').find('.kodomo').slideToggle();

//     // ここでクラス 'active' の切り替えを行う
//     $(this).toggleClass('active');
//   });
// });

// $(document).ready(function () {
//   $('#editPostModal').on('shown.bs.modal', function () {
//     // モーダルが表示されたときの処理を追加
//   });
// });

$(function () {
  // ページ読み込み後にアコーディオンメニューを非表示にする
  $('.according-menu').hide();
  $('.arrow-icon').click(function () {
    // ここで要素の表示/非表示を切り替える
    $(this).parent().find('.according-menu').slideToggle();

    // ここでクラス 'active' の切り替えを行う
    $(this).toggleClass('active');
  });
});
