/**
 * @author seb
 */
package business.delegates {
	
	import com.adobe.cairngorm.business.ServiceLocator;
	
	import mx.rpc.IResponder;
	import mx.rpc.remoting.RemoteObject;
	
	import vo.Setting;	
	public class SettingsDelegate {
	
		private var _responder:IResponder;
		private var _service:RemoteObject = ServiceLocator.getInstance().getRemoteObject("settingsService");
			
		public function SettingsDelegate(responder:IResponder) {
			super();
			_responder = responder;
		}
		
		public function load():void{
			_service.load().addResponder(_responder);
		}

		public function add(setting:Setting, table:String):void{
			_service.add(setting, table).addResponder(_responder);
		}

		public function del(setting:Setting, table:String):void{
			_service.del(setting, table).addResponder(_responder);
		}
	}

}