<?php 
  // Interfaces
  interface ChannelInterface {
    public function register();
  }

  class YouTube implements ChannelInterface {
    public function getService(){}
    public function register(){}
    public function getPlaylists(){}
    public function getPlaylistItems(){}
  }
  class TikTok implements ChannelInterface  {
    public function register(){}
  }
  class FaceBook implements ChannelInterface  {
    public function register(){}
  }
