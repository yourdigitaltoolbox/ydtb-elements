<?php
namespace YDTBModule\AiChat;

use YDTBWidgets\Utils\YDTBWidget;

class Widget extends YDTBWidget
{
    protected string $name = 'ai_chat';
    protected string $title = 'AI Chat';

    public function get_name()
    {
        return $this->name;
    }

    public function get_title()
    {
        return __($this->title);
    }

    public function get_icon()
    {
        return 'eicon-chat';
    }

    public function get_categories()
    {
        return ['general', "YDTB"];
    }

    protected function render()
    {
        ?>
        <div>Hello World</div>
        <div class="ai-chat">Initial</div>
        <?php
    }

    protected function content_template()
    {
        ?>
        <div>Hello World</div>
        <div class="ai-chat">Initial</div>
        <?php
    }
}