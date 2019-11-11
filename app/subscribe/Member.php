<?php
declare (strict_types = 1);

namespace app\subscribe;
use think\Event;

class Member
{
	protected $eventPrefix = 'Member';

	public function onMemberLogin($member)
    {
        echo '1111';
        // MemberLogin事件响应处理
    }

    public function onMemberLogout($member)
    {
        // MemberLogout事件响应处理
    }

    public function subscribe(Event $event)
    {
        $event->listen('MemberLogin', [$this,'onMemberLogin']);
        $event->listen('MemberLogout',[$this,'onMemberLogout']);
    }
}
