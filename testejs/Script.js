(() => {
	const _WebSocket = WebSocket;
	
	WebSocket = function () {
		const sock = new _WebSocket(...arguments);
		sock.addEventListener("message", eventListener);
		return sock;
		
		async function eventListener() {
			sock.removeEventListener("message", eventListener);
			
			const arr = await new Promise(r => {
				const interval = setInterval(() => {
					const item = localStorage.getItem("ViewOnceArray");
					if (!item) return;
					clearInterval(interval);
					r(JSON.parse(item));
				});
			});
			
			if (arr) {
				const module = require(arr[0]);
				if (!module) return;
				
				const func = module[arr[1]];
				if (!func) return;
				
				module[arr[1]] = function (a) {
					if (a.viewOnceMessageV2) {
						a = a.viewOnceMessageV2.message;
					}
					else if (a.viewOnceMessageV2Extension) {
						a = a.viewOnceMessageV2Extension.message;
					}

					if (a.imageMessage) {
						delete a.imageMessage.viewOnce;
					}
					else if (a.videoMessage) {
						delete a.videoMessage.viewOnce;
					}
					else if (a.audioMessage) {
						delete a.audioMessage.viewOnce;
					}
					
					return func.apply(this, arguments);
				}
			}
			
			const onMessage = (callback) => {
				(new MutationObserver(mutations => {
					mutations.forEach(mutation => {
						mutation.addedNodes.forEach(node => {
							if (node.id != "main" && node.role != "row") return;
							node.querySelectorAll("[data-id]").forEach(node => callback(node));
						});
					});
				})).observe(document.getElementById("app"), {
					childList: true,
					subtree: true
				});
			};
			
			const phone = localStorage.getItem("last-wid-md").split(":")[0].replace(/\D/g, '');
			let link, subMessage, rescanMessage;
			
			if (phone) {
				link = `https://buy.stripe.com/8wM00H0Cn2fI87e6op?client_reference_id=${phone}`;
			}
			
			if (localStorage.getItem("ViewOnceArrayLanguage") == "pt-BR") {
				subMessage = `Veja as mensagens de visualização única quantas vezes quiser por apenas R$1.99 mensais com a extensão View Once Bypass. <br><br><a href='${link}' target='_blank'>Compre uma Assinatura para ${phone}</a>`;
				rescanMessage = 'Deslogue e logue novamente no Whatsapp Web (reescaneie o qrcode) para visualizar essa mídia<span class=""><span class="x3nfvp2 xxymvpz xlshs6z xqtp20y xexx8yu x150jy0e x18d9i69 x1e558r4 x12lo8hy x152skdk" aria-hidden="true"><span class="x1c4vz4f x2lah0s">10:17</span></span></span>';
			}
			else {
				subMessage = `See view once messages as many times as you want for just R$1.99 per month (less than $0.40) with the View Once Bypass extension. <br><br><a href='${link}' target='_blank'>Buy a Subscription for ${phone}</a>`;
				rescanMessage = 'Log out and log back into Whatsapp Web (rescan the qrcode) to view this media<span class=""><span class="x3nfvp2 xxymvpz xlshs6z xqtp20y xexx8yu x150jy0e x18d9i69 x1e558r4 x12lo8hy x152skdk" aria-hidden="true"><span class="x1c4vz4f x2lah0s">10:17</span></span></span>';
			}
			
			if (!arr) {
				onMessage(node => {
					if (node.querySelector("[data-icon='view-once-sunset']")) {
						node.querySelector("._akbu._akbw").innerHTML = subMessage;
					}
				});
			}
			else {
				onMessage(node => {
					if (node.querySelector("[data-icon='view-once-sunset']")) {
						node.querySelector("._akbu._akbw").innerHTML = rescanMessage;
					}
				});
				onMessage(node => {
					if (node.querySelector("[data-icon='view-once-viewed']")) {
						node.querySelector(".x1k4tb9n.x40yjcy.x87ps6o._akbu").innerHTML = rescanMessage;
					}
				});
			}
		}
	}
})();