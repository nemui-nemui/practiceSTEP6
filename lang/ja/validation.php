<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
        'accepted'             => ':attributeを承認してください。',
        'active_url'           => ':attributeが有効なURLではありません。',
        'after'                => ':attributeには、:date以降の日付を指定してください。',
        'after_or_equal'       => ':attributeには、:date以降または同日の日付を指定してください。',
        'alpha'                => ':attributeには、アルファベッドのみ使用できます。',
        'alpha_dash'           => ':attributeには、アルファベットとダッシュ(-)及び下線(_)が使用できます。',
        'alpha_num'            => ':attributeには、アルファベットと数字が使用できます。',
        'array'                => ':attributeには、配列を指定してください。',
        'before'               => ':attributeには、:date以前の日付を指定してください。',
        'before_or_equal'      => ':attributeには、:date以前または同日の日付を指定してください。',
        'between'              => [
            'numeric' => ':attributeは、:minから:maxの間で指定してください。',
            'file'    => ':attributeは、:min KBから:max KBの間で指定してください。',
            'string'  => ':attributeは、:min文字から:max文字の間で指定してください。',
            'array'   => ':attributeは、:min個から:max個の間で指定してください。',
        ],
        'boolean'              => ':attributeには、trueかfalseを指定してください。',
        'confirmed'            => ':attributeと:attribute確認が一致しません。',
        'date'                 => ':attributeは、正しい日付ではありません。',
        'date_format'          => ':attributeの形式は、:formatと一致していません。',
        'different'            => ':attributeと:otherには、異なるものを指定してください。',
        'digits'               => ':attributeは、:digits桁で指定してください。',
        'digits_between'       => ':attributeは、:min桁から:max桁の間で指定してください。',
        'dimensions'           => ':attributeの画像サイズが無効です。',
        'distinct'             => ':attributeには、重複する値があります。',
        'email'                => ':attributeは、有効なメールアドレス形式で指定してください。',
        'ends_with'            => ':attributeは、:valuesのいずれかで終わらなければなりません。',
        'exists'               => '選択された:attributeは、有効ではありません。',
        'file'                 => ':attributeには、ファイルを指定してください。',
        'filled'               => ':attributeには、値を指定してください。',
        'gt'                   => [
            'numeric' => ':attributeは、:valueより大きくなければなりません。',
            'file'    => ':attributeは、:value KBより大きくなければなりません。',
            'string'  => ':attributeは、:value文字より大きくなければなりません。',
            'array'   => ':attributeは、:value個より多くのアイテムを含まなければなりません。',
        ],
        'gte'                  => [
            'numeric' => ':attributeは、:value以上でなければなりません。',
            'file'    => ':attributeは、:value KB以上でなければなりません。',
            'string'  => ':attributeは、:value文字以上でなければなりません。',
            'array'   => ':attributeは、:value個以上のアイテムを含まなければなりません。',
        ],
        'image'                => ':attributeには、画像ファイルを指定してください。',
        'in'                   => '選択された:attributeは、有効ではありません。',
        'in_array'             => ':attributeは、:otherに含まれていません。',
        'integer'              => ':attributeには、整数を指定してください。',
        'ip'                   => ':attributeには、有効なIPアドレスを指定してください。',
        'ipv4'                 => ':attributeには、有効なIPv4アドレスを指定してください。',
        'ipv6'                 => ':attributeには、有効なIPv6アドレスを指定してください。',
        'json'                 => ':attributeには、有効なJSON文字列を指定してください。',
        'lt'                   => [
            'numeric' => ':attributeは、:valueより小さくなければなりません。',
            'file'    => ':attributeは、:value KBより小さくなければなりません。',
            'string'  => ':attributeは、:value文字より小さくなければなりません。',
            'array'   => ':attributeは、:value個より少ないアイテムでなければなりません。',
        ],
        'lte'                  => [
            'numeric' => ':attributeは、:value以下でなければなりません。',
            'file'    => ':attributeは、:value KB以下でなければなりません。',
            'string'  => ':attributeは、:value文字以下でなければなりません。',
            'array'   => ':attributeは、:value個以下のアイテムでなければなりません。',
        ],
        'max'                  => [
            'numeric' => ':attributeは、:max以下で指定してください。',
            'file'    => ':attributeは、:max KB以下で指定してください。',
            'string'  => ':attributeは、:max文字以下で指定してください。',
            'array'   => ':attributeは、:max個以下で指定してください。',
        ],
        'mimes'                => ':attributeには、:valuesタイプのファイルを指定してください。',
        'mimetypes'            => ':attributeには、:valuesタイプのファイルを指定してください。',
        'min'                  => [
            'numeric' => ':attributeは、:min以上で指定してください。',
            'file'    => ':attributeは、:min KB以上で指定してください。',
            'string'  => ':attributeは、:min文字以上で指定してください。',
            'array'   => ':attributeは、:min個以上で指定してください。',
        ],
        'multiple_of'          => ':attributeは、:valueの倍数でなければなりません。',
        'not_in'               => '選択された:attributeは、有効ではありません。',
        'not_regex'            => ':attributeの形式が無効です。',
        'numeric'              => ':attributeには、数値を指定してください。',
        'password'             => 'パスワードが違います。',
        'present'              => ':attributeが存在していなければなりません。',
        'prohibited'           => ':attributeフィールドは禁止されています。',
        'prohibited_if'        => ':otherが:valueである場合、:attributeフィールドは禁止されています。',
        'prohibited_unless'    => ':otherが:valuesでない限り、:attributeフィールドは禁止されています。',
        'prohibits'            => ':attributeは、:otherの存在を禁止します。',
        'regex'                => ':attributeには、有効な正規表現を指定してください。',
        'required'             => ':attributeは、必須項目です。',
        'required_if'          => ':otherが:valueの場合、:attributeは必須です。',
        'required_unless'      => ':otherが:valuesでない限り、:attributeは必須です。',
        'required_with'        => ':valuesが存在する場合、:attributeは必須です。',
        'required_with_all'    => ':valuesが全て存在する場合、:attributeは必須です。',
        'required_without'     => ':valuesが存在しない場合、:attributeは必須です。',
        'required_without_all' => ':valuesが全て存在しない場合、:attributeは必須です。',
        'same'                 => ':attributeと:otherは一致しなければなりません。',
        'size'                 => [
            'numeric' => ':attributeは、:sizeを指定してください。',
            'file'    => ':attributeは、:size KBを指定してください。',
            'string'  => ':attributeは、:size文字を指定してください。',
            'array'   => ':attributeは、:size個を指定してください。',
        ],
        'starts_with'          => ':attributeは、:valuesのいずれかで始まらなければなりません。',
        'string'               => ':attributeには、文字を指定してください。',
        'timezone'             => ':attributeには、有効なタイムゾーンを指定してください。',
        'unique'               => ':attributeの値は既に存在しています。',
        'uploaded'             => ':attributeのアップロードに失敗しました。',
        'url'                  => ':attributeには、有効なURLを指定してください。',
        'uuid'                 => ':attributeには、有効なUUIDを指定してください。',
    

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

];
