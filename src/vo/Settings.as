/**
 * @author seb
 */
package vo
{
	[Bindable]
	[RemoteClass(alias="SettingsVO")]
	public class Settings
	{	
		public var description:Object;
		public var langList:Array;
		public var qualityList:Array;
		public var videoCodecList:Array;
		public var audioCodecList:Array;
		public var containerList:Array;
		public var separatorKeywordsList:Array;
		public var pathList:Array;
		public var unwantedCharsList:Array;
	}
}