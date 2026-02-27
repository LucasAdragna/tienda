# Frontend Conventions

Esta guía define la estructura y reglas que vamos a usar siempre en `frontend`.

## 1) Estructura base

```txt
frontend/
  public/
  src/
    app/
    assets/
    components/
      layout/
      ui/
      common/
    features/
    hooks/
    lib/
    services/
      api/
      http/
      mappers/
    store/
    types/
    utils/
    constants/
    config/
    validators/
    styles/
    tests/
      unit/
      integration/
```

## 2) Regla principal de organización

- Organización por dominio en `features` y por capas compartidas en carpetas globales.
- Si algo pertenece claramente a una feature, va en `features/<feature>/...`.
- Si algo es reutilizable por varias features, va en carpetas globales (`components`, `services`, `hooks`, etc.).

## 3) Convenciones por carpeta

- `app/`: solo rutas, layouts, page files y composición de pantalla.
- `components/layout/`: estructura global de UI (Header, Footer, Navbar).
- `components/ui/`: componentes base reutilizables y presentacionales.
- `components/common/`: bloques reutilizables de negocio entre páginas.
- `features/<nombre>/`: módulo autocontenido de negocio (componentes, hooks, services, types locales).
- `hooks/`: hooks compartidos entre features.
- `services/http/`: cliente HTTP base (fetch/axios, interceptores, headers).
- `services/api/`: funciones de acceso a endpoints.
- `services/mappers/`: transformación DTO <-> modelo de dominio.
- `store/`: estado global y slices/stores.
- `types/`: tipos compartidos del proyecto.
- `utils/`: funciones puras sin acoplamiento a framework.
- `constants/`: constantes globales (keys, rutas, límites).
- `config/`: configuración derivada de entorno.
- `validators/`: esquemas y reglas de validación.
- `styles/`: estilos globales y tokens CSS.
- `tests/unit` y `tests/integration`: pruebas unitarias e integración.

## 4) Convenciones de nombres

- Componentes React: `PascalCase.tsx` (`ProductCard.tsx`).
- Hooks: `useXxx.ts` (`useProducts.ts`).
- Utilidades/servicios: `camelCase.ts` (`formatPrice.ts`, `productApi.ts`).
- Tipos: `*.types.ts` o `types.ts` por módulo.
- Constantes: `UPPER_SNAKE_CASE` para valores, archivo en `camelCase.ts`.
- Evitar mezcla de idiomas en nombres. Usar un solo idioma por proyecto (recomendado: inglés técnico).

## 5) Imports y dependencias

- Usar alias `@/*` para imports absolutos desde `src`.
- Evitar imports profundos entre features (`features/a` no depende de internals de `features/b`).
- `app` puede importar de `features` y carpetas compartidas.
- `components/ui` no debe depender de lógica de negocio.

## 6) Regla de crecimiento

- Cuando una sección crezca, moverla a `features/<dominio>`.
- Cuando algo se reutilice en 2+ features, promoverlo a carpeta compartida.
- Mantener archivos pequeños y con una sola responsabilidad.

## 7) Plantilla de feature

```txt
src/features/productos/
  components/
  hooks/
  services/
  types/
  validators/
  index.ts
```

## 8) Checklist rápido

- ¿El archivo está en la carpeta correcta según responsabilidad?
- ¿El nombre cumple convención?
- ¿Se evitó acoplamiento innecesario entre features?
- ¿Se puede testear de forma aislada?
- ¿Hay código duplicado que deba pasar a `ui`, `utils` o `services`?

