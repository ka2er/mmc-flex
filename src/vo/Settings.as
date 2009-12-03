/**
 * @author seb
 */
package vo
{
	//import mx.collections.ArrayCollection
	//import vo.Setting
		
	[Bindable]
	[RemoteClass(alias="SettingsVO")]
	public class Settings
	{	
		public var langList:Array
		public var qualityList:Array
		public var videoCodecList:Array
		public var audioCodecList:Array
		public var containerList:Array
		public var separatorKeywordsList:Array
		public var pathList:Array
		public var unwantedCharsList:Array
	}
}