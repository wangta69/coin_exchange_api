

업비트 비공식 API 형식
https://crix-api-endpoint.upbit.com/v1/crix/candles/기간타입/기간?code=CRIX.UPBIT.마켓-암호화폐기호&count=시세데이터수&to=최종시세데이터일시


prefix Url : https://crix-api-endpoint.upbit.com/v1/crix/


BTC의 원화마켓 10분 차트의 최종 2개 시세 데이터 세트 가져오기 (최종일시: 2017-12-27 05:10:00 UTC)
candles/minutes/10?code=CRIX.UPBIT.KRW-BTC&count=2&to=2017-12-27%2005:10:00

BTC의 원화마켓 4시간 차트의 최종 1개 시세 데이터 세트 가져오기 (최종 일시: 가장 최근 시세 데이터 일시)
candles/minutes/240?code=CRIX.UPBIT.KRW-BTC

SBD의 BTC마켓 1일 차트의 최종 3개 시세 데이터 세트 가져오기 (최종 일시: 가장 최근 시세 데이터 일시)
candles/days?code=CRIX.UPBIT.BTC-SBD&count=3

STEEM의 BTC마켓 1주 차트의 최종 1개 시세 데이터 세트 가져오기 (최종 일시: 가장 최근 시세 데이터 일시)
candles/weeks?code=CRIX.UPBIT.BTC-STEEM

ETH의 BTC마켓 1달 차트의 최종 5개 시세 데이터 세트 가져오기 (최종 일시: 2017-12-20 00:00:00 UTC)
candles/months?code=CRIX.UPBIT.BTC-ETH&count=5&to=2017-12-20%2000:00:00

업비트 비공식 API 형식 (추가)
UTC 기준 금일 00:00 부터 조회 시점시 까지의 시세 데이터를 15분 간격으로 모두 출력해주는 다음 API도 있습니다.

candles/lines?code=CRIX.UPBIT.마켓-암호화폐기호

마켓: KRW, BTC, ETH, USDT
암호화폐기호: BTC, ETH, XRP, STEEM, SBD 등 각 마켓의 지원 암호화폐
candles/lines?code=CRIX.UPBIT.KRW-BTC

BTC의 원화마켓 시세 데이터를 15분 간격으로 모두 출력 (UTC 기준 금일 00:00 부터 조회 시점시 까지)





trades/ticks?code=CRIX.UPBIT.KRW-'.$currency.'&count=1');