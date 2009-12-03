package business.events
{
	import com.adobe.cairngorm.control.CairngormEvent;
	
	import vo.Setting;
	
	//en cairngorm standard, on créerait 3 classe différentes pour chaque évènement
	//mais optimiser un peu en créeant un méthode Factory pour créer la bonne classe évènement
	public class SettingEvent extends CairngormEvent
	{
		static public const CREATE_SETTING:String = "events.setting.createItemEvent"
		static public const UPDATE_SETTING:String = "events.setting.updateItemEvent"
		static public const DELETE_SETTING:String = "events.setting.deleteItemEvent"
		
		public var setting:Setting
		public var setting_name:String
		
		public function SettingEvent(eventName:String, xsetting:Setting, name:String)
		{
			super(eventName)
			this.setting = xsetting;
			this.setting_name = name
		}
		static public function getCreateEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(CREATE_SETTING, setting, name)
		}
		static public function getUpdateEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(UPDATE_SETTING, setting, name)
		}
		static public function getDeleteEvent(setting:Setting, name:String):SettingEvent
		{
			return new SettingEvent(DELETE_SETTING, setting, name)
		}
	}
}