<?php
if (!isset($AcceptOrder)) {
    $AcceptOrder = function ($args) use ($provider, $token, $repository, $sms) {
        $user = $repository->findUserByOrderId($args['orderid']);
        $gsm = $repository->getFirstGsm($user);
        if ($gsm) {
            $message = $repository->getSmsMessage('AcceptOrder', [$user->firstname, $user->lastname, $args['orderid']]);
            $sms($gsm, $message,$args['orderid'],$user->id);
        }
    };
}

return $AcceptOrder;
