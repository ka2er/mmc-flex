/**
 * @author seb
 */
package business.delegates {
	
	import business.Services;
	
	import mx.rpc.IResponder;
	import mx.rpc.remoting.RemoteObject;
	
	import vo.Film;
	
	public class FilmDelegate {
	
		private var _responder:IResponder;
		private var _service:RemoteObject = Services.getInstance().services.filmsService;
					
		public function FilmDelegate(responder:IResponder) {
			super();
			_responder = responder;
		}
		
		public function load():void{
			//_service.simulateFetchAll().addResponder(_responder)
			_service.fetchAll().addResponder(_responder);	
		}
		
		public function rename(film:Film, name:String):void{
			_service.rename(film, name).addResponder(_responder);
		}
		
		public function getExtraInfos(film:Film):void {
			_service.getExtraInfos(film).addResponder(_responder);
		}
	}

}