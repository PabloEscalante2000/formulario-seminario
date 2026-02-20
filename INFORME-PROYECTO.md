# Sistema de Invitaciones - Lanzamiento del Libro "El Amor es un Delirio"

## Descripcion general

Este sistema permite gestionar las invitaciones para el evento de lanzamiento del libro "El Amor es un Delirio". Funciona como una plataforma web donde se generan enlaces unicos de invitacion, los invitados confirman su asistencia mediante un formulario, y reciben un correo electronico con un codigo QR que sirve como entrada al evento.

**Direccion web:** https://formulario.elamoresundelirio.com

---

## Como funciona

### 1. Generacion de invitaciones (administrador)

El administrador accede al panel de administracion en la direccion:

> https://formulario.elamoresundelirio.com/admin/login

Desde ahi puede:

- **Generar tokens de invitacion:** Cada token crea un enlace unico. Este enlace es el que se envia al invitado (por WhatsApp, correo, mensaje directo, etc.).
- **Ver el estado de los tokens:** Cada token aparece como "Disponible" (aun no usado) o "Usado" (el invitado ya se registro).
- **Copiar el enlace facilmente:** Junto a cada enlace disponible hay un boton para copiarlo al portapapeles.
- **Filtrar tokens:** Se pueden ver todos los tokens, solo los disponibles o solo los usados.
- **Ver los registros:** Una tabla muestra todos los invitados que ya confirmaron su asistencia, incluyendo su nombre, correo, lo que esperan del evento, numero de acompanantes y fecha de registro.

### 2. Registro del invitado

Cuando el invitado recibe su enlace unico y lo abre en el navegador, ve un formulario donde debe completar:

- Nombre
- Apellido
- Correo electronico
- Que espera del lanzamiento
- Numero de acompanantes

Al enviar el formulario, el sistema:

1. Guarda los datos del invitado.
2. Marca el token como usado (no puede volver a utilizarse).
3. Muestra un mensaje de confirmacion en pantalla.
4. Envia automaticamente un **correo electronico de confirmacion**.

### 3. Correo de confirmacion con codigo QR

El invitado recibe en su correo electronico:

- Un saludo personalizado con su nombre.
- Los datos de su registro (nombre completo, correo, numero de acompanantes).
- Un **codigo QR** que debe presentar en la entrada del evento.
- Un enlace de respaldo por si no puede ver la imagen del QR.

El correo se envia desde la direccion **contacto@institutoitas.com**.

### 4. Verificacion en la entrada del evento (escaneo del QR)

El dia del evento, el personal de entrada escanea el codigo QR del invitado con cualquier celular. Al escanearlo:

- **Si el invitado esta registrado:** Se muestra una pantalla verde con los datos del invitado (nombre, correo, acompanantes, fecha de registro). Esto confirma que la persona esta invitada y puede ingresar.
- **Si el codigo no es valido:** Se muestra una pantalla roja indicando que no se encontro un registro asociado.

No se necesita ninguna aplicacion especial para escanear el QR; basta con la camara del celular, que abrira automaticamente la pagina de verificacion en el navegador.

---

## Flujo resumido

```
Administrador genera token
        |
        v
Se envia el enlace al invitado
        |
        v
El invitado abre el enlace y llena el formulario
        |
        v
El sistema confirma el registro y envia un correo con QR
        |
        v
En el evento, se escanea el QR para verificar al invitado
```

---

## Datos importantes

| Concepto | Detalle |
|----------|---------|
| Direccion del sistema | https://formulario.elamoresundelirio.com |
| Panel de administracion | https://formulario.elamoresundelirio.com/admin/login |
| Correo que envia las confirmaciones | contacto@institutoitas.com |
| Cada enlace de invitacion | Solo puede usarse una vez |
| Codigo QR | Unico por cada invitado registrado |

---

## Preguntas frecuentes

**Si un invitado pierde su correo de confirmacion, puede volver a registrarse?**
No. El enlace de invitacion solo funciona una vez. El administrador deberia generar un nuevo token y enviarselo.

**Se puede saber cuantas personas asistiran en total?**
Si. En el panel de administracion se ve la lista de registros con el numero de acompanantes de cada invitado.

**Que pasa si alguien intenta usar un enlace que ya fue utilizado?**
El sistema muestra un mensaje indicando que la invitacion ya no es valida.

**Se necesita internet para verificar el QR en la entrada?**
Si. El celular que escanea el QR necesita conexion a internet para abrir la pagina de verificacion.
