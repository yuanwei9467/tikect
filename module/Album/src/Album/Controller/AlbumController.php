<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Zend\Config\Writer\PhpArray;

class AlbumController extends AbstractActionController{
	protected $albumTable;
	
	public function getAlbumTable(){
		if (!$this->albumTable) {
             $sm = $this->getServiceLocator();
             $this->albumTable = $sm->get('Album\Model\AlbumTable');
         }
         return $this->albumTable;
	}
	
	public function indexAction(){
		return new ViewModel(array('albums'=>$this->getAlbumTable()->fetchAll()));
	}
	
	public function editAction(){
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();
			$album = new Album();
			$album->exchangeArray($post);
			$this->getAlbumTable()->saveAblum($album);
			return $this->redirect()->toRoute('album');
		}
		$id = (int)$this->params()->fromRoute('id',0);
		return new ViewModel(array('row'=>$this->getAlbumTable()->getAblum($id)));
	}
	
	public function deleteAction(){
		
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$album = new Album();
			$album->exchangeArray($data);
			$this->getAlbumTable()->saveAblum($album);
			return $this->redirect()->toRoute('album');
		}
		return new ViewModel();
	}
	
	public function weatherAction(){
		$content = file_get_contents('http://wishblog.sinaapp.com/378');
		preg_match('/<p>中国天气网城市代码：<\/p>(.*)<\/div>/iUs', $content,$matchs);
		preg_match_all('/(.*?)<br \/>/', $matchs[1],$citys);
		$cityCodes = array();
		foreach ($citys[1] as $k=>$v){
			$str = strip_tags($v);
			$str = explode('=', $str);
			$cityCodes[$str[1]]['code'] = $str[0];
		}
		$phpArray = new PhpArray();
		$phpArray->toFile('cityCodes', $cityCodes);
	}
	
	private function toFile($filename, $config){
		
	}
}


