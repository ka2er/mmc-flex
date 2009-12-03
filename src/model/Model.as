/**
 * @author seb
 */
package model
{
	import com.adobe.cairngorm.model.ModelLocator;
	
	import mx.collections.ArrayCollection;
	
	import vo.Film;
	import vo.Setting;
	import vo.Settings;
	
	[Bindable]
	public class Model implements ModelLocator
	{
		// singleton
		private static var _instance:Model = null
		
		// vues
		public static const HOME_VIEW:Number=0
		public static const FILMS_LIST_VIEW:Number=1
		
		// etat navigation general
		public var appNavigation:Number = HOME_VIEW
		
		// variables globales de data		
		public var films:ArrayCollection
		public var film:Film = new Film()

		public var setting:Setting /* parametre en cours */
		public var settings:Settings /* liste des parametres */
		public var settingNameCollection:ArrayCollection /* liste des noms de parametres sour forme de tableaux */
		
		public var search:String
		
		public var DEBUG:* = null
		
		public function Model()
		{
			if(_instance!=null) throw new Error("Une seule instance doit exister"); 
		}
		
		public static function getInstance():Model {
			if(_instance == null)
				_instance = new Model()
				 
			return _instance; 
		}
	}
}