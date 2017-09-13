<?php

/*
 *  Class is ASLANMEDYA 2016
 */

class sPagination
{

	public $total;
	public $limit;
	public $scroll = 10;
	public $request;
	public $previous_text = 'Geri'; 
	public $next_text = 'İleri';
	public $first_text = 'İlk';
	public $end_text = 'Son';

	private $page_num;
	private $sayfala;

    /*
     *  Sayfalama Fonksiyonu
     *  @return string
     */
    function Paginate(){
	
		$this->page_num = !empty($_GET[$this->request]) ? $_GET[$this->request] : NULL;
		
		if($this->page_num == '' or !is_numeric($this->page_num) or !intval($this->page_num)){
            $this->page_num = 1;
        }

		$this->ortalama = ceil($this->total/$this->limit);
		
		if($this->page_num > $this->ortalama){
            $this->page_num = 1;
        }

        $i_previous = NULL;
		if($this->page_num > 1){
			$i_previous = '<a href="'.$this->page.''.$this->request.'=1">'.$this->first_text.'</a>';
		}

        $i_next = NULL;
		if($this->page_num < $this->ortalama){
            $i_next = '<a href="'.$this->page.''.$this->request.'='.$this->ortalama.'">'.$this->end_text.'</a>';
        }

		if($this->page_num <= 1){
            $previous = '<a href="#">'.$this->previous_text.'</a>';
        } else{
            $previous_a = $this->page_num-1;
            $previous = '<a href="'.$this->page.''.$this->request.'='.$previous_a.'">'.$this->previous_text.'</a>';
        }

		if($this->page_num == $this->ortalama){
            $next = '<a href="#">'.$this->next_text.'</a>';
        } else{
            $next_a = $this->page_num + 1;
            $next = '<a href="'.$this->page.''.$this->request.'='.$next_a.'">'.$this->next_text.'</a>';
        }

		$this->sayfala .= $i_previous;
		$this->sayfala .= $previous;

		$pn = ceil($this->page_num/$this->scroll);
		$scroll = $this->scroll * $pn;

		if($this->page_num <= $this->scroll){
            $count = 1;
        } else{
            $count = $pn * $this->scroll - $this->scroll + 1;
        }

		if($scroll > $this->ortalama){
            $scroll = $this->ortalama;
        }
		
		for($i=$count; $i<=$scroll; $i++){
            if($this->page_num == $i){
                $secili = '<a href="#" class="active">'.$i.'</a>';
            } else{
                $secili = '<a href="'.$this->page.''.$this->request.'='.$i.'">'.$i.'</a>';
            }
            $this->sayfala .= $secili;
		}
		
		$this->sayfala .= $next;
		$this->sayfala .= $i_next;

        return $this->sayfala;
	}

}

?>
