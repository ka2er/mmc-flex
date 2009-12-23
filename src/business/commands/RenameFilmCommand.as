/**
 * @author seb
 */
package business.commands {

	import business.delegates.FilmDelegate;
	import business.events.FilmEvent;
	import business.events.LoadFilmsEvent;
	
	import com.adobe.cairngorm.commands.ICommand;
	import com.adobe.cairngorm.commands.SequenceCommand;
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import model.Model;
	
	import mx.controls.Alert;
	import mx.rpc.IResponder;
	


	public class RenameFilmCommand extends SequenceCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance();
				
		override public function execute(e:CairngormEvent):void
		{
			nextEvent = new LoadFilmsEvent();			
			new FilmDelegate(this).rename(FilmEvent(e).film, FilmEvent(e).name);			
		}
		
		public function result(r:Object):void {
			
			
			if(r.result) { // si on recoit un 1 le renommage est OK => on envoit l'evenement suivant
			    executeNextCommand();
			} else {
				Alert.show('Erreur lors du déplacement');	
			}
			//_model.settings = r.result as Settings

		}
		
		public function fault(f : Object):void {
			Alert.show("RenameFilmCommand : Erreur lors du renommage" + f);
		}
	}
}