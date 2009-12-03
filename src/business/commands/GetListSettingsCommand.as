/**
 * @author seb
 */
package business.commands {

	import business.delegates.SettingsDelegate;
	
	import com.adobe.cairngorm.commands.ICommand
	import com.adobe.cairngorm.control.CairngormEvent
	
	import model.Model
	import vo.Settings
	import vo.Setting
	
	
	import mx.collections.ArrayCollection
	import mx.rpc.IResponder;
	import mx.controls.Alert


	public class GetListSettingsCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance()
				
		public function execute(e:CairngormEvent):void
		{
			new SettingsDelegate( this ).getList()			
		}
		
		public function result(r:Object):void {
			_model.settingList = r.result as Array
		}
		
		public function fault(f : Object):void{
			Alert.show("GetListSettingsCommand : Erreur de chargement de la liste des paramêtres"+f)	
		}
	}
}