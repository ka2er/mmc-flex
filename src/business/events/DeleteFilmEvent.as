/**
 * @author seb
 */
package business.events {
	
	import com.adobe.cairngorm.control.CairngormEvent
		
			
	public class DeleteFilmEvent extends CairngomEvent{
		
		static public var EVENT_ID:String = "DELETE_FILM"
			
		public var filmId:Number=null	
				
		public function DelteFilmEvent(id:Number) {
			super(EVENT_ID)
			filmId = id
		}
	}

}