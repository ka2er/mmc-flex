/**
 * @author seb
 */
package business.events {
	
	import com.adobe.cairngorm.control.CairngormEvent;
		
			
	public class LoadSettingsEvent extends CairngormEvent{
		
		static public var EVENT_ID:String = "LOAD_SETTINGS";
				
		public function LoadSettingsEvent() {
			super(EVENT_ID);
		}
	}

}