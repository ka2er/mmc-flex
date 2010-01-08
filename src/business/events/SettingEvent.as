package business.events
{
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import vo.Setting;
	
	//en cairngorm standard, on créerait 3 classe différentes pour chaque évènement
	//mais optimiser un peu en créeant un méthode Factory pour créer la bonne classe évènement
	public class SettingEvent extends CairngormEvent
	{
		static public const CREATE_SETTING:String = "events.setting.createItemEvent";
		static public const UPDATE_SETTING:String = "events.setting.updateItemEvent";
		static public const DELETE_SETTING:String = "events.setting.deleteItemEvent";
		static public const REORDER_SETTING:String = "events.setting.reorderItemEvent";
		
		public var setting:Setting;
		public var setting_name:String;
		public var opt_data:String; /* opt for extra data */
		
		public function SettingEvent(eventName:String, xsetting:Setting, name:String, extra:String = '')
		{
			super(eventName);
			this.setting = xsetting;
			this.setting_name = name;
			this.opt_data = extra;
		}
		static public function getCreateEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(CREATE_SETTING, setting, name);
		}
		static public function getUpdateEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(UPDATE_SETTING, setting, name);
		}
		static public function getDeleteEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(DELETE_SETTING, setting, name);
		}
		static public function getReorderEvent(setting:Setting, name:String, sens:String):SettingEvent
		{
			return new SettingEvent(REORDER_SETTING, setting, name, sens);
		}
	}
}