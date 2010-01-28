/**
 * @author seb
 */
package business.commands {

	import business.delegates.SettingsDelegate;
	
	import com.adobe.cairngorm.commands.ICommand;
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import flash.utils.describeType;
	
	import model.Model;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.rpc.IResponder;
	
	import vo.Settings;


	public class LoadSettingsCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance();
				
		public function execute(e:CairngormEvent):void
		{
			new SettingsDelegate( this ).load();		
		}
		
		public function result(r:Object):void {
			// l'objets settings complet
			_model.settings = r.result as Settings;
			
			
			// la liste des parametres n'est initialisés qu'une fois...
			if(_model.settingNameCollection == null) {
				var settingsInfo:XML = describeType(_model.settings);
				var ac:ArrayCollection = new ArrayCollection();
				var prop:String;
				var table:String;
				for each (var v:XML in settingsInfo..accessor) {
					
					prop = v.@name;
				
					// ignore attributes not defining list...
					if(prop.substr(-4) != 'List') continue;
				
					table = prop.substr(0, prop.length -4); // -4 pour virer xxxList...
					table = table.replace(/([A-Z])/g, "_$1").toLowerCase(); // tableName => table_name ...
					ac.addItem({prop:prop, table:table});
				}
				_model.settingNameCollection = ac;
			}
		}
		
		public function fault(f : Object):void {
			Alert.show("LoadSettingsCommand : Erreur de chargement des paramêtres"+f);	
		}
	}
}