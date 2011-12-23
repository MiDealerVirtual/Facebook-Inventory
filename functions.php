<?php 
	
	/*------------------------------------------------------------
	FUNCTION NAME:	paginationStart(Done Function)
	FUNCTION DESCRIPTION: To paginate page(Header of pagination)
	--------------------------------------------------------------*/	
	function paginationStart($total_rec,$per_page){
		
		global $num_pages;
		global $next_page;
		global $prev_page;
	
		$prev_page = $page - 1;
		$next_page = $page + 1;
		
		if ($total_rec <= $per_page){
			$num_pages = 1;
		}else if (($total_rec % $per_page) == 0){
			$num_pages = ($total_rec / $per_page);
		}else{
			$num_pages = ($total_rec / $per_page) + 1;
		}
		$num_pages = (int) $num_pages;
		return $num_pages;
	}
	/*------------------------------------------------------------
	FUNCTION NAME:	paginationFooter(Done Function)
	FUNCTION DESCRIPTION: To paginate page(Footer of Pagination)
	--------------------------------------------------------------*/	
	function paginationFooter($queryString,$targetPage,$totalPages,$nextPage,$prevPage){
		//$queryString= Extra variables that you want to send with querystring. like this name=$name&type=1 etc
		//$targetPage = Page to be paginated
		//$totalPages=Total number of pages;
		//$nextPage=Next page number;	
		//$prevPage=Previous page number;		
		$num_pages=$totalPages;
		$prev_page=$prevPage;
		$next_page=$nextPage;
		$page=$_GET['page'];
		if ($prev_page){
		   echo "<a href=$targetPage?page=$prev_page&$queryString>Previous</a>";
		}
		if ($num_pages>1){
			if($page>5)
				$st_page=$page-5;
			else
				$st_page=1;		
		
			if($num_pages>10 && ($num_pages-$page)>5)
				$end_page=$page+5;
			else
				$end_page=$num_pages;		
		
			for($kk=$st_page;$kk<=$end_page;$kk++){
				if($kk==$page)
				echo "&nbsp;$kk&nbsp;";
				else
				echo "&nbsp;<a href=$targetPage?page=$kk&$queryString>$kk</a>&nbsp;";
			}
		}
		if ($page != $num_pages){
			if($num_pages!=1){
			   echo "<a href=$targetPage?page=$next_page&$queryString>Next </a>";
			}
		}
	}
?>