      <span>差出人：</sp>
      <span>record.skmtsr@gmail.com</span>
      <span>宛先：</span>
      <span>{{ $to_email }}</span>
          <div>パスワード再設定</div>
    </tr>
  </table>
</div>
<h2>パスワード再発行</h2>
<div>以下のURLをクリックしてパスワードを再発行してください</div>
@if (app()->environment(['local', 'staging']))
    <a href="http://localhost:8000/password-reset-page">http://localhost:8000/password-reset-page</a>
@elseif (app()->environment(['production']))
    <a href="https://ik1-407-35703.vs.sakura.ne.jp/password-reset-page">https://ik1-407-35703.vs.sakura.ne.jp/password-reset-page</a>
@endif

