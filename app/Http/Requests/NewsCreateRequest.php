<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Carbon\Carbon;

class NewsCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tiptitle' => 'required',
            'tipimg1' =>'required',
            'tipcontent' => 'required',
            'publish_date' => 'required',
            'publish_time' => 'required',
        ];
    }

     /**
     * Return the fields and values to create a new post from
     */
    public function postFillData()
    {
        $published_at = new Carbon(
            $this->publish_date.' '.$this->publish_time
        );
        return [
            'tiptitle' => $this->tiptitle,
            'tipimg1' => $this->tipimg1,
            'tipcontent' => $this->tipcontent,
            'tipvideo' => $this->tipvideo,
            'commentflag'=>$this->commentflag,
            'draftflag'=>$this->draftflag,
            'stime' => $published_at,
            'readnum' => $this->readnum,
            'proid' => $this->proid,
            'voteflag'=>$this->voteflag,
            'votenum'=>$this->votenum,
            'vbtime'=>new Carbon($this->vote_begin_date.' '.$this->vote_begin_time),
            'vetime'=>new Carbon($this->vote_end_date.' '.$this->vote_end_time),
        ];
    }

     /**
     * Return the fields and values to create a new post from
     */
    public function postFillDataEX()
    {
        $published_at = new Carbon(
            $this->publish_date.' '.$this->publish_time
        );
        return [
            'tiptitle' => $this->tiptitle,
            'tipimg1' => $this->tipimg1,
            'tipcontent' => $this->tipcontent,
            'tipvideo' => $this->tipvideo,
            'commentflag'=>$this->commentflag,
            'draftflag'=>$this->draftflag,
            'stime' => $published_at,
            'readnum' => $this->readnum,
            'proid' => $this->proid,
            'voteflag'=>$this->voteflag,
            'votenum'=>$this->votenum,
            'vbtime'=>new Carbon($this->vote_begin_date.' '.$this->vote_begin_time),
            'vetime'=>new Carbon($this->vote_end_date.' '.$this->vote_end_time),
        ];
    }
}
