package kj.test.com.msgtest;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.content.IntentFilter;
import android.net.Uri;
import android.content.*;
import android.util.Log;
import android.widget.TextView;
import android.widget.Button;
import android.view.View.OnClickListener;
import android.view.View;

public class UrlActivity extends Activity {
	Uri data;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_url);

		// 보내온 인텐드를 받아서 URI분석 하는 부분.
		Intent intent = getIntent();
		data = intent.getData();
		Log.d("TAG", data.toString());
		TextView tv = (TextView) findViewById(R.id.textView2);
		tv.setText("Query = " + data.getQuery() + "current UID = "
				+ MainActivity.userID);

		// 받아온 코드를 보내는 부분.
		Button accept = (Button) findViewById(R.id.button1);
		OnClickListener acceptListener = new OnClickListener() {
			@Override
			public void onClick(View v) {
				// 내정보 : 아이디를 추가해서 보내야함.
				// PHP코드, Mission Details 에서 보낸 내용
				/*
				 * msg[0] =
				 * me.down('textfield[itemId=mission-name-field]').missionID;
				 * msg[1] = me.down('selectfield[name=trade-store]').getValue();
				 * msg[2] = me.down('sliderfield').getValue(); 
				 * msg[3] = me.userId;
				 * msg[4]
				 * = me.down('selectfield[name=trade-mission-field]').getValue();
				 */
				
				/*String parser[] = data.getQuery().split(",");
				

				Intent intent = new Intent(
						Intent.ACTION_VIEW,
						Uri.parse("http://165.132.121.77/php/saveMission.php?" +
								"missionID="+ parser[0] + "&" +
								"storeID=" + parser[1] + "&"  +
								"pointVal=" + parser[2] + "&" +
								"senderID=" + parser[3] + "&" +
								"myID=" + MainActivity.userID +
								""
								));
		*/
				Intent intent = new Intent( Intent.ACTION_VIEW, 
						Uri.parse("http://211.43.193.17/php/saveMission.php?msg="+data.getQuery()+","+
								MainActivity.userID));
				startActivity(intent);
			}
		};
		accept.setOnClickListener(acceptListener);

		Button cancle = (Button) findViewById(R.id.button2);
		OnClickListener cancleListener = new OnClickListener() {
			@Override
			public void onClick(View v) {
				android.os.Process.killProcess(android.os.Process.myPid());
			}
		};
		cancle.setOnClickListener(cancleListener);
	}
	/*
	 * private BroadcastReceiver mBroadcastReceiver = new BroadcastReceiver() {
	 * 
	 * @Override public void onReceive(Context context, Intent intent) { Uri
	 * test = intent.getData(); Log.d("TAG", test.toString()); } };
	 */

}
