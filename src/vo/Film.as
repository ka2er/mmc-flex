/**
 * @author seb
 */
package vo
{
	[Bindable]
	[RemoteClass(alias="FilmVO")]
	public class Film
	{	
		public var video_codec:String
		public var audio_codec:String
		public var resolution:String
		public var nb_audio_stream:String
		
		public var titre:String
		
		public var file:String
		public var path:String
		public var ext:String
		
	}
}