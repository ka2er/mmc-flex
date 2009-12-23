/**
 * @author seb
 */
package business.events {
	
	import com.adobe.cairngorm.control.CairngormEvent;
		
			
	public class LoadFilmsEvent extends CairngormEvent{
		
		static public var EVENT_ID:String = "LOAD_FILMS";
				
		public function LoadFilmsEvent() {
			super(EVENT_ID);
		}
	}

}