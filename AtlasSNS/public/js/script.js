

$(function () {
  $('.arrow-icon').click(function () {
    // ここで要素の表示/非表示を切り替える
    $('.kodomo').slideToggle();

    // ここでクラス 'active' の切り替えを行う
    $(this).toggleClass('active');
  });
});

$(document).ready(function () {
  $('#editPostModal').on('shown.bs.modal', function () {
    // モーダルが表示されたときの処理を追加
  });
});
