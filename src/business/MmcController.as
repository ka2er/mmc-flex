/**
 * @author seb
 */
package business {
	import business.commands.CreateNfoCommand;
	
	import business.commands.AddSettingCommand;
	import business.commands.DelSettingCommand;
	import business.commands.ReorderSettingCommand;
	import business.commands.GetExtraInfosFilmCommand;
	import business.commands.LoadFilmsCommand;
	import business.commands.LoadSettingsCommand;
	import business.commands.RenameFilmCommand;
	
	import business.events.FilmEvent;
	import business.events.LoadFilmsEvent;
	import business.events.LoadSettingsEvent;
	import business.events.SettingEvent;
	
	import com.adobe.cairngorm.control.FrontController;	
			
	public class MmcController extends FrontController {
		public function MmcController() {
			super();
			
			addCommand(LoadFilmsEvent.EVENT_ID, 		LoadFilmsCommand);
			addCommand(LoadSettingsEvent.EVENT_ID, 		LoadSettingsCommand);
			addCommand(SettingEvent.CREATE_SETTING, 	AddSettingCommand);
			addCommand(SettingEvent.DELETE_SETTING, 	DelSettingCommand);
			addCommand(SettingEvent.REORDER_SETTING, 	ReorderSettingCommand);
			addCommand(FilmEvent.RENAME_FILM, 			RenameFilmCommand);
			addCommand(FilmEvent.GET_EXTRA_INFOS_FILM, 	GetExtraInfosFilmCommand);
			addCommand(FilmEvent.CREATE_NFO,			CreateNfoCommand);
		}
	}
}