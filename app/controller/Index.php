<?php

namespace app\controller;

use app\BaseController;
use Orhanerday\OpenAi\OpenAi;

class Index extends BaseController
{
    /*public function index()
    {
        return '<style>*{ padding: 0; margin: 0; }</style><iframe src="https://www.thinkphp.cn/welcome?version=' . \think\facade\App::version() . '" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>';
    }

    public function hello($name = 'ThinkPHP8')
    {
        return 'hello,' . $name;
    }*/

    /**
     * openai对接接口
     * @return void
     */
    public function question(){
        $question = $this->request->post('question','');
        $open_ai_key = "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";//你的key
        $open_ai = new OpenAi($open_ai_key);
        $open_ai->setProxy("http://127.0.0.1:7890");//本地调试代理
        // 返回文本
        $complete = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "user",
                    "content" => $question
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        $returnData = json_decode($complete,true);
        return json_encode($returnData);

    }

}
