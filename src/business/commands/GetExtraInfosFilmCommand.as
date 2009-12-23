/**
 * @author seb
 */
package business.commands {

	import business.delegates.FilmDelegate;
	import business.events.FilmEvent;
	import business.events.LoadFilmsEvent;
	
	import com.adobe.cairngorm.commands.ICommand;
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import model.Model;
	
	import mx.controls.Alert;
	import mx.rpc.IResponder;
	
	import vo.Film;

	public class GetExtraInfosFilmCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance();
				
		public function execute(e:CairngormEvent):void
		{
			new FilmDelegate(this).getExtraInfos(FilmEvent(e).film);	
		}
		
		public function result(r:Object):void {
			
			if(r.result) {
				_model.film = r.result as Film;
			} else {
				Alert.show("Erreur lors lors de la récupération d'infos supplémentaires");	
			}
		}
		
		public function fault(f : Object):void {
			Alert.show("getExtraInfosCommand : Erreur lors lors de la récupération d'infos supplémentaires" + f);
		}
	}
}