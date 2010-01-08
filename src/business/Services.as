package business
{
	import flash.utils.Dictionary;
	
	import mx.core.Application;
	import mx.messaging.Channel;
	import mx.messaging.ChannelSet;
	import mx.messaging.channels.AMFChannel;
	import mx.rpc.remoting.RemoteObject;
	
	public class Services
	{
		
		public var services:Dictionary;
		
		// singleton
		private static var _instance:Services = null;

		public function Services()
		{
			if(_instance!=null) throw new Error("Une seule instance doit exister"); 
							
			services = new Dictionary();
			
			/* def du service PHP distant */
			var channelSet:ChannelSet = new ChannelSet();
			var zendChannel:Channel = new AMFChannel("zend-endpoint", Application.application.parameters.server);
			channelSet.addChannel(zendChannel);

			var ro_film:RemoteObject = new RemoteObject();
			ro_film.destination = "zend";
			ro_film.channelSet = channelSet;
			ro_film.source = 'films';
			ro_film.showBusyCursor = true;
			services.filmsService = ro_film;

			var ro_settings:RemoteObject = new RemoteObject();
			ro_settings.destination = "zend";
			ro_settings.channelSet = channelSet;
			ro_settings.source = 'settings';
			ro_settings.showBusyCursor = true;
			services.settingsService = ro_settings;
		}
		
		public static function getInstance():Services {
			if(_instance == null)
				_instance = new Services();
				 
			return _instance; 
		}
	}
}