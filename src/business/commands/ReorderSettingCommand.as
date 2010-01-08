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
	
	import mx.controls.Alert;
	import mx.rpc.IResponder;

	public class ReorderSettingCommand extends SequenceCommand implements ICommand, IResponder {
		
		override public function execute(e:CairngormEvent):void
		{
			nextEvent = new LoadSettingsEvent();			
			new SettingsDelegate( this ).reorder(SettingEvent(e).setting, SettingEvent(e).setting_name, SettingEvent(e).opt_data);			
		}
		
		public function result(r:Object):void {
			if(r.result) // si on recoit un ID le reorder est OK => on envoit l'evenement suivant
			    executeNextCommand();
		}
		
		public function fault(f : Object):void {
			Alert.show("ReorderSettingCommand : Erreur lors du reordonnancement");	
		}
	}
}