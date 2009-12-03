/**
 * @author seb
 */
package business {
	
	import business.commands.AddSettingCommand;
	import business.commands.DelSettingCommand;
	import business.commands.LoadFilmsCommand;
	import business.commands.RenameFilmCommand;
	import business.commands.GetExtraInfosFilmCommand;
	import business.commands.LoadSettingsCommand;
	
	import business.events.LoadSettingsEvent;
	import business.events.SettingEvent;
	import business.events.LoadFilmsEvent;
	import business.events.FilmEvent;
	
	import com.adobe.cairngorm.control.FrontController;	
			
	public class MmcController extends FrontController {
		public function MmcController() {
			super()
			
			addCommand(LoadFilmsEvent.EVENT_ID, LoadFilmsCommand)
			addCommand(LoadSettingsEvent.EVENT_ID, LoadSettingsCommand)
			addCommand(SettingEvent.CREATE_SETTING, AddSettingCommand)
			addCommand(SettingEvent.DELETE_SETTING, DelSettingCommand)
			addCommand(FilmEvent.RENAME_FILM, RenameFilmCommand)
			addCommand(FilmEvent.GET_EXTRA_INFOS_FILM, GetExtraInfosFilmCommand)
			
		}
	}

}