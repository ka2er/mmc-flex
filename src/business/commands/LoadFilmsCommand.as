/**
 * @author seb
 */
package business.commands {

	import business.delegates.FilmDelegate;
	
	import com.adobe.cairngorm.commands.ICommand;
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import model.Model;
	
	import mx.collections.ArrayCollection;
	import mx.rpc.IResponder;
	import mx.controls.Alert;


	public class LoadFilmsCommand implements ICommand, IResponder {
		
		private var _model:Model = Model.getInstance();
				
		public function execute(e:CairngormEvent):void
		{
			new FilmDelegate( this ).load();			
		}
		
		public function result(r:Object):void {
			_model.films = new ArrayCollection(r.result);
		}
		
		public function fault(f : Object):void{
			Alert.show("LoadFilmsCommand : Erreur de chargement de la liste "+f);	
		}
	}
}