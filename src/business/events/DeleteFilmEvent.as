/**
 * @author seb
 */
package business.events {
	
	import com.adobe.cairngorm.control.CairngormEvent;
		
			
	public class DeleteFilmEvent extends CairngormEvent{
		
		static public var EVENT_ID:String = "DELETE_FILM";
			
		public var filmId:Number;
				
		public function DeleteFilmEvent(id:Number) {
			super(EVENT_ID);
			filmId = id;
		}
	}

}