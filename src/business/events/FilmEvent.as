package business.events
{
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import vo.Film;
	
	//en cairngorm standard, on créerait 3 classe différentes pour chaque évènement
	//mais optimiser un peu en créeant un méthode Factory pour créer la bonne classe évènement
	public class FilmEvent extends CairngormEvent
	{
		static public const RENAME_FILM:String = "events.film.renameEvent";
		static public const GET_EXTRA_INFOS_FILM:String = "events.film.getExtraInfosEvent";
		static public const CREATE_NFO:String = "events.film.createNfo";
		
		public var film:Film;
		public var name:String;
		
		public function FilmEvent(eventName:String, xfilm:Film, name:String)
		{
			super(eventName);
			this.film = xfilm;
			this.name = name;
		}
		
		static public function renameEvent(film:Film, name:String):FilmEvent
		{
			return new FilmEvent(RENAME_FILM, film, name);
		}
		
		static public function getExtraInfosEvent(film:Film):FilmEvent
		{
			return new FilmEvent(GET_EXTRA_INFOS_FILM, film, '');
		}
		
		static public function createNfoEvent(film:Film, txt:String):FilmEvent {
			return new FilmEvent(CREATE_NFO, film, txt);
		}
		
	}
}