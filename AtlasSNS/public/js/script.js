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


$(document).ready(function () {
  // ボタンにホバー時の画像切り替えを追加
  // $('.btn-delete').hover(
  //   function () {
  //     // ホバー時の画像またはアイコンのパスを指定
  //     $(this).html('<img src="/images/trash-h.png" alt="削除"> ');
  //   },
  //   function () {
  //     // 元のテキストまたはアイコンに戻す
  //     $(this).html('<img src="/images/trash.png" alt="削除"> ');
  //   }
  // );

  // 削除ボタンがクリックされたときの処理
  $('.btn-delete').on('click', function () {
    var postId = $(this).data('postid');
    console.log(postId);
    $('#deleteModal').show();

    // 削除確認モーダル内の削除ボタンがクリックされたときの処理
    $('#confirmDelete').on('click', function () {
      // ここで削除の非同期処理を実装
      // ...

      // モーダルを閉じる
      $('#deleteModal').modal('hide');
    });
  });
});
