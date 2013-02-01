package kj.test.com.msgtest;

import android.net.Uri;
import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.util.Log;

public class MainActivity extends Activity {
    class CallMySpace
    {
    		public void CallMP(String msg)
    		{
    			Log.d("TAG", msg);
    			
    			//인텐트 콜
    			String sendmsg = "mypto://sendMessage?message=" + msg;
    			Uri u = Uri.parse(sendmsg);
    			Intent it = new Intent(Intent.ACTION_VIEW, u);
    			startActivity(it);
    		}
    		public void Hello()
    		{
    			Log.d("TAG", "Hello World");
    		}
    		public void SetUserID(String _uID)
    		{
    			userID = _uID;
    			
    			Log.d("USER ID", "userID = " + userID);
    		}
    }
	
    private class WebViewClientClass extends WebViewClient { 
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) { 
            view.loadUrl(url); 
            return true; 
        } 
    }
    
    
    //웹뷰는 인터넷 퍼미션이 있어야 동작한다.
	private WebView mWebView;
	public static String userID="2";
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mWebView = (WebView)findViewById(R.id.webView1);
        //자바 스크립트 실행 가능
        
        mWebView.getSettings().setJavaScriptEnabled(true);
        mWebView.clearCache(true);
        mWebView.getSettings().setAppCacheEnabled(false);
        
        //mWebView.getSettings().setAllowContentAccess(true);
        //mWebView.getSettings().setSupportMultipleWindows(true);
        
        //바로 콜이 안되서 자바 스크립트 인터페이스 활용
        mWebView.addJavascriptInterface(new CallMySpace(), "CallMySpace");
        
        // 서비스 홈페이지 지정
        mWebView.loadUrl("http://211.43.193.17");
        
        // WebViewClient 지정
        mWebView.setWebViewClient(new WebViewClientClass());  
    }
    
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
    
}
