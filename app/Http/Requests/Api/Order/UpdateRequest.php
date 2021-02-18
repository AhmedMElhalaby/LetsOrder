<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed order_id
 * @property mixed status
 * @property mixed reject_reason
 * @property mixed cancel_reason
 */
class UpdateRequest extends ApiRequest
{
    use ResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id'=>'required|exists:orders,id',
            'status'=>'required|in:'.Constant::ORDER_STATUSES_RULES
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Order)->find($this->order_id);
        switch ($this->status){
            case Constant::ORDER_STATUSES['Approved']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['PendingApproval']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Approved']);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Approved']);
                Functions::SendNotification($Object->user,'Order Approved','Provider Approved your order !','الموافقة على الطلب !','قام المزود بالموافقة على طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Rejected']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['PendingApproval']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Rejected']);
                $Object->setRejectReason(@$this->reject_reason);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Rejected']);
                Functions::SendNotification($Object->user,'Order Rejected','Provider Rejected your order !','الرفض على الطلب !','قام المزود برفض طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Canceled']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['PendingApproval']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Canceled']);
                $Object->setCancelReason(@$this->cancel_reason);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Canceled']);
                Functions::SendNotification($Object->provider,'Order Canceled','Customer Canceled the order !','إلغاء الطلب !','قام المستخدم بإلغاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['NotReceived']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Approved']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['NotReceived']);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['NotReceived']);
                Functions::SendNotification($Object->user,'Order Not Received','Customer did not receive the order !','لم يتم استلام الطلب !','لم يقم المستخدم باستلام الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['NotDelivered']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Received']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['NotDelivered']);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['NotDelivered']);
                Functions::SendNotification($Object->provider,'Order Not Delivered','Provider did not deliver the order !','لم يتم توصيل الطلب !','لم يقم المزود بتوصيل الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Received']:{
                if (($Object->getStatus() !=Constant::ORDER_STATUSES['Approved']) ) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Received']);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Received']);
                Functions::SendNotification($Object->user,'Order Received','Customer Received the order !','تم تسليم الطلب !','قام المستخدم باستلام الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Finished']:{
                if (($Object->getStatus() !=Constant::ORDER_STATUSES['Received']) || ($Object->getStatus() !=Constant::ORDER_STATUSES['NotDelivered'])|| ($Object->getStatus() !=Constant::ORDER_STATUSES['NotReceived'])) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Finished']);
                $Object->setIsFinished(true);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Finished']);
                Functions::SendNotification($Object->provider,'Order Finished','Customer confirmed receiving the order !','تم انهاء الطلب !','أكد المستخدم استلامه للطلب !',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
        }
        $Object->save();
        return $this->successJsonResponse([__('messages.updated_successful')],new OrderResource($Object),'Order');
    }
}
