<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        /**
         * select 쿼리에서 해당 컬럼을 조회하지 않거나 조회 결과가 없으면
         * $this 에 해당 변수가 없으므로 null 값 반환
         */

        /**
         * 리소스 부모 객체 선택에 따른 사용법 : class TodoCollection extends JsonResource
         */
        return [
            'id' => $this->id,
            'title_collcet' => sprintf('제목 : %s', $this->title),
            'content_collcet' => sprintf('내용 : %s', $this->content),
            'created_at_collcet' => $this->getCreatedAtAttribute($this->created_at)
        ];

        /**
         * 리소스 부모 객체 선택에 따른 사용법 : class TodoCollection extends ResourceCollection
         */
        // final array to be return.
//        $products = [];
//        foreach($this->collection as $product) {
//            array_push($products, [
//                'id' => $product->id,
//                'title_collcet' => sprintf('제목 : %s', $product->title),
//                'content_collcet' => sprintf('내용 : %s', $product->content),
//                'created_at_collcet' => $this->getCreatedAtAttribute($product->created_at)
//            ]);
//        }
//        return $products;
    }

    /**
     * datetime 가공
     * argument 가 없으면 현재 시간으로 처리됨
     * @param $value : DB 에서 조회된 datetime 값
     * @return string
     */
    public function getCreatedAtAttribute($value){
        $dtm = Carbon::parse($value);
        return sprintf('%s (%s에 작성됨)', $dtm->format('Y-m-d H:i:s'), $dtm->diffForHumans());
    }
}
