<?php 
  //任意入力項目の配列が空の場合のエラーメッセージ制御
  error_reporting(E_ALL ^ E_NOTICE);

  //サーバーサイドバリデーション
  $postData = $_POST;
  $isValidateError = true;
  $validateErrors = array();
  function formValidation($postData) {

    //エラーメッセージ初期化
    $validateErrors = array();

    //必須項目チェック対象指定
    $requiredCheck = array(
      // '全角テキスト' => $postData['input_text'],
      // 'カタカナ' => $postData['input_kana'],
      'メールアドレス' => $postData['input_email'],
      '電話番号' => $postData['input_tel'],
      // 'URL' => $postData['input_url'],
      // '郵便番号' => $postData['input_zipcode'],
      // 'ラジオボタン' => $postData['input_radio'],
      // 'チェックボックス' => $postData['input_checkbox'],
      'セレクトボックス' => $postData['input_selectbox'],
      // '複数行テキスト' => $postData['input_textarea']
    );

    // //全角文字チェック対象指定
    // $doubleByteCheck = array(
    //   '全角テキスト' => $postData['input_text']
    // );

    // //全角カタカナチェック対象指定
    // $doubleByteKanaCheck = array(
    //   'カタカナ' => $postData['input_kana']
    // );

    //メールアドレスフォーマットチェック対象指定
    $emailFormatCheck = array(
      'メールアドレス' => $postData['input_email']
    );

    //電話・FAX番号フォーマットチェック対象指定
    $telFormatCheck = array(
      '電話番号' => $postData['input_tel']
    );

    // //URLフォーマットチェック対象指定
    // $urlFormatCheck = array(
    //   'URL' => $postData['input_url']
    // );

    // //郵便番号フォーマットチェック対象指定
    // $zipcodeFormatCheck = array(
    //   '郵便番号' => $postData['input_zipcode']
    // );

    //必須項目バリデートチェック
    foreach ($requiredCheck as $key => $value) {
      if(empty($value)) {
        $validateErrors[] = $key.'の項目は必須入力です';
      }
    }

    // //全角文字バリデートチェック
    // foreach ($doubleByteCheck as $key => $value) {
    //   if(!preg_match('/^[ぁ-んァ-ヶー一-龠 　rnt]+$/',$value)) {
    //     $validateErrors[] = $key.'の項目はすべて全角文字で入力してください';
    //   }
    // }

    // //全角カタカナ文字バリデートチェック
    // foreach ($doubleByteKanaCheck as $key => $value) {
    //   if(!preg_match('/^[ア-ン゛゜ァ-ォャ-ョー「」、]+$/',$value)) {
    //     $validateErrors[] = $key.'の項目はすべて全角カタカナで入力してください';
    //   }
    // }

    //メールアドレスバリデートチェック
    foreach ($emailFormatCheck as $key => $value) {
      if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/',$value)) {
        $validateErrors[] = $key.'を正しく入力してください';
      }
    }

    // //電話番号バリデートチェック
    // foreach ($telFormatCheck as $key => $value) {
    //   if(!preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',$value)) {
    //     $validateErrors[] = $key.'を正しく入力してください';
    //   }
    // }

    // //URLバリデートチェック
    // foreach ($urlFormatCheck as $key => $value) {
    //   if(!preg_match('/http(s)?://([w-]+.)+[w-]+(/[w-./?%&=]*)?/',$value)) {
    //     $validateErrors[] = $key.'を正しく入力してください';
    //   }
    // }

    // //郵便番号バリデートチェック
    // foreach ($zipcodeFormatCheck as $key => $value) {
    //   if(!preg_match('/^d{3}[-]d{4}$|^d{7}$/',$value)) {
    //     $validateErrors[] = $key.'を正しく入力してください';
    //   }
    // }

    return $validateErrors;
  }
  $validateErrors = formValidation($postData);
  if(empty($validateErrors)) {
    $isValidateError = false;
  } else {
    $isValidateError = true;
  }
?>