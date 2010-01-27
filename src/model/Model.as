/**
 * @author seb
 */
package model
{
	import mx.core.Application;
	import com.adobe.cairngorm.model.ModelLocator;
	
	import mx.collections.ArrayCollection;
	
	import vo.Film;
	import vo.Setting;
	import vo.Settings;
	
	[Bindable]
	public class Model implements ModelLocator
	{
		// singleton
		private static var _instance:Model = null;
		
		// vues
		public static const HOME_VIEW:Number=0;
		public static const FILMS_LIST_VIEW:Number=1;
		
		// etat navigation general
		public var appNavigation:Number = HOME_VIEW;
		
		// variables globales de data		
		public var films:ArrayCollection;
		public var film:Film = new Film();

		public var setting:Setting; /* parametre en cours */
		public var settings:Settings; /* liste des parametres */
		public var settingNameCollection:ArrayCollection; /* liste des noms de parametres sour forme de tableaux */
		
		// url diverses
		public var php_server_url:String = 'http://films-flex/server.php';
		public var bug_report_url:String = 'http://github.com/ka2er/mmc-flex/issues';
		
		public var DEBUG:* = null;
		
		public function Model()
		{
			if(_instance!=null) throw new Error("Une seule instance doit exister"); 
		}
		
		public static function getInstance():Model {
			if(_instance == null) {
				_instance = new Model();
			
				if(Application.application && Application.application.parameters.server) 
					_instance.php_server_url = Application.application.parameters.server;
			}
				 
			return _instance; 
		}
	}
}