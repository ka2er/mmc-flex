/**
 * @author seb
 */
package business.commands {

	import business.delegates.SettingsDelegate;
	import business.events.LoadSettingsEvent;
	import business.events.SettingEvent;
	
	import com.adobe.cairngorm.commands.ICommand;
	import com.adobe.cairngorm.commands.SequenceCommand;
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import model.Model;
	
	import mx.controls.Alert;
	import mx.rpc.IResponder;
	
	import vo.Settings;

	public class AddSettingCommand extends SequenceCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance();
				
		override public function execute(e:CairngormEvent):void
		{
			nextEvent = new LoadSettingsEvent();			
			new SettingsDelegate( this ).add(SettingEvent(e).setting, SettingEvent(e).setting_name);	
		}
		
		public function result(r:Object):void {
			
			if(r.result) // si on recoit un ID le ADD est OK => on envoit l'evenement suivant
			    executeNextCommand();
			
			//_model.settings = r.result as Settings

		}
		
		public function fault(f : Object):void {
			Alert.show("AddSettingCommand : Erreur lors de l'ajout");	
		}
	}
}