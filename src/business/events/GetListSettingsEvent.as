/**
 * @author seb
 */
package business.events {
	
	import com.adobe.cairngorm.control.CairngormEvent
		
			
	public class GetListSettingsEvent extends CairngormEvent{
		
		static public var EVENT_ID:String = "GET_LIST_SETTINGS"
				
		public function GetListSettingsEvent() {
			super(EVENT_ID)
		}
	}

}